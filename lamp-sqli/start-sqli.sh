#!/bin/bash
# 
# Starts the docker container via docker compose utilities 
#   debugs out a command to copy/paste to view the logs of the running containers
# 
# 
DOCKER_COMPOSE_CMD=""

# Check for 'docker-compose' (as part of Docker CLI)
if which "docker-compose" &> /dev/null; then
    DOCKER_COMPOSE_CMD="docker-compose"
# Check for 'docker compose' (as the standalone binary)
elif which "docker" &> /dev/null; then
    DOCKER_COMPOSE_CMD="docker compose"
else
    echo "Neither 'docker compose' nor 'docker-compose' binary is available."
    exit 1
fi

# Run 'docker compose up' using the found command
$DOCKER_COMPOSE_CMD up -d

echo "=============================================================================="
echo "to see logs from the container run (in the same directory as this script):"
echo ""
echo "$DOCKER_COMPOSE_CMD logs -f"
echo ""
echo "=============================================================================="
echo "to kill the container run (in the same directory as this script):"
echo ""
echo "$DOCKER_COMPOSE_CMD down"
echo ""
echo "=============================================================================="
echo "to see what's running in docker (to verify open ports, etc), run this in any location:"
echo ""
echo "docker ps"
echo ""
echo "=============================================================================="
echo ""
echo "visit http://localhost:8888 to browse this server"

