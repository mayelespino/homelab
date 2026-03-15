FROM optiwariindia/vscode-tunnel:latest

USER root

# Install dependencies
RUN apt-get update && apt-get install -y \
    wget \
    curl \
    git \
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

# Create Go workspace and fix permissions
RUN mkdir -p /home/node/go/{bin,src,pkg} \
    && mkdir -p /home/node/.vscode/cli \
    && chown -R node:node /home/node

# Switch back to the default user
USER node
