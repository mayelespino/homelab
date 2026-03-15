FROM optiwariindia/vscode-tunnel:latest

USER root

# Install gcc and common build tools
RUN apt-get update && apt-get install -y \
    gcc \
    g++ \
    make \
    build-essential \
    && rm -rf /var/lib/apt/lists/*

# Ensure /home/node is fully owned by node user
RUN mkdir -p /home/node/.vscode/cli \
    && chown -R node:node /home/node

# Switch back to the default user
USER node
