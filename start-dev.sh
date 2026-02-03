#!/bin/bash

# Talib Development Environment Startup Script
# This script starts all services needed for local development

echo "🚀 Starting Talib Development Environment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$PROJECT_DIR"

# Function to check if a command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Function to check if a port is in use
port_in_use() {
    lsof -i :$1 >/dev/null 2>&1
}

# Check prerequisites
echo -e "${YELLOW}Checking prerequisites...${NC}"

if ! command_exists php; then
    echo -e "${RED}PHP is not installed!${NC}"
    exit 1
fi

if ! command_exists composer; then
    echo -e "${RED}Composer is not installed!${NC}"
    exit 1
fi

if ! command_exists npm; then
    echo -e "${RED}NPM is not installed!${NC}"
    exit 1
fi

echo -e "${GREEN}✓ All prerequisites met${NC}"

# Check if .env exists
if [ ! -f .env ]; then
    echo -e "${YELLOW}Creating .env from .env.example...${NC}"
    cp .env.example .env
    php artisan key:generate
fi

# Install dependencies if needed
if [ ! -d "vendor" ]; then
    echo -e "${YELLOW}Installing PHP dependencies...${NC}"
    composer install
fi

if [ ! -d "node_modules" ]; then
    echo -e "${YELLOW}Installing Node dependencies...${NC}"
    npm install
fi

# Clear caches
echo -e "${YELLOW}Clearing caches...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run migrations
echo -e "${YELLOW}Running database migrations...${NC}"
php artisan migrate --force

# Kill any existing processes on our ports
echo -e "${YELLOW}Checking for existing processes...${NC}"

if port_in_use 8000; then
    echo -e "${YELLOW}Stopping existing PHP server on port 8000...${NC}"
    lsof -ti :8000 | xargs kill -9 2>/dev/null
fi

if port_in_use 5173; then
    echo -e "${YELLOW}Stopping existing Vite server on port 5173...${NC}"
    lsof -ti :5173 | xargs kill -9 2>/dev/null
fi

# Start PHP development server in background
echo -e "${GREEN}Starting PHP development server on http://localhost:8000...${NC}"
php artisan serve --port=8000 &
PHP_PID=$!

# Wait a moment for server to start
sleep 2

# Start Vite for frontend assets
echo -e "${GREEN}Starting Vite development server...${NC}"
npm run dev &
VITE_PID=$!

# Wait for Vite to start
sleep 3

# Test API connections
echo ""
echo -e "${YELLOW}Testing API connections...${NC}"

# Test home page
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8000)
if [ "$HTTP_CODE" == "200" ]; then
    echo -e "${GREEN}✓ Home page: OK (HTTP $HTTP_CODE)${NC}"
else
    echo -e "${RED}✗ Home page: FAILED (HTTP $HTTP_CODE)${NC}"
fi

# Test registration pages
for route in teacher school kindergarten nursery educational-center; do
    HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" "http://localhost:8000/register/$route")
    if [ "$HTTP_CODE" == "200" ]; then
        echo -e "${GREEN}✓ Registration ($route): OK${NC}"
    else
        echo -e "${RED}✗ Registration ($route): FAILED (HTTP $HTTP_CODE)${NC}"
    fi
done

# Test search
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8000/search)
if [ "$HTTP_CODE" == "200" ]; then
    echo -e "${GREEN}✓ Search page: OK${NC}"
else
    echo -e "${RED}✗ Search page: FAILED (HTTP $HTTP_CODE)${NC}"
fi

# Test API endpoints
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8000/api/countries)
if [ "$HTTP_CODE" == "200" ]; then
    echo -e "${GREEN}✓ API /countries: OK${NC}"
else
    echo -e "${YELLOW}⚠ API /countries: HTTP $HTTP_CODE${NC}"
fi

echo ""
echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Development environment is running!${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""
echo -e "Backend:  ${YELLOW}http://localhost:8000${NC}"
echo -e "Frontend: ${YELLOW}http://localhost:5173${NC}"
echo ""
echo -e "Press ${RED}Ctrl+C${NC} to stop all servers"
echo ""

# Open browser
if command_exists open; then
    sleep 2
    open "http://localhost:8000"
elif command_exists xdg-open; then
    sleep 2
    xdg-open "http://localhost:8000"
fi

# Function to cleanup on exit
cleanup() {
    echo ""
    echo -e "${YELLOW}Shutting down servers...${NC}"
    kill $PHP_PID 2>/dev/null
    kill $VITE_PID 2>/dev/null
    echo -e "${GREEN}Servers stopped.${NC}"
    exit 0
}

# Trap Ctrl+C
trap cleanup SIGINT SIGTERM

# Wait for background processes
wait
