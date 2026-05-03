FROM optiwariindia/vscode-tunnel:latest

USER root

# Install dependencies
RUN apt-get update && apt-get install -y \
    wget \
    curl \
    git \
    sudo \
    gcc \
    libc6-dev \
    pkg-config \
    && rm -rf /var/lib/apt/lists/*

# Install the latest stable Go
RUN GOVERSION=$(curl -s https://go.dev/VERSION?m=text | head -1) \
    && wget -q https://dl.google.com/go/${GOVERSION}.linux-amd64.tar.gz \
    && tar -C /usr/local -xzf ${GOVERSION}.linux-amd64.tar.gz \
    && rm ${GOVERSION}.linux-amd64.tar.gz

# Set Go environment variables
ENV PATH="/usr/local/go/bin:$PATH"
ENV GOPATH="/home/node/go"
ENV GOBIN="/home/node/go/bin"
ENV CGO_ENABLED=1

# Create Go workspace and fix permissions
RUN mkdir -p /home/node/go/{bin,src,pkg} \
    && mkdir -p /home/node/.vscode/cli \
    && usermod -aG sudo node \
    && echo 'node ALL=(ALL) NOPASSWD:ALL' > /etc/sudoers.d/node \
    && chmod 0440 /etc/sudoers.d/node \
    && chown -R node:node /home/node

# Ensure interactive shells (e.g. VS Code tunnel) pick up Go in PATH
RUN echo 'export PATH="/usr/local/go/bin:$PATH"' >> /home/node/.bashrc

# Switch back to the default user
USER node
