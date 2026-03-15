FROM optiwariindia/vscode-tunnel:latest

USER root

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    gcc \
    build-essential \
    && rm -rf /var/lib/apt/lists/*

# Set Rust environment variables
ENV RUSTUP_HOME="/usr/local/rustup"
ENV CARGO_HOME="/usr/local/cargo"
ENV PATH="/usr/local/cargo/bin:$PATH"

# Install the latest stable Rust via rustup
RUN curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | \
    sh -s -- -y --default-toolchain stable --no-modify-path

# Ensure /home/node is fully owned by node user
RUN mkdir -p /home/node/.vscode/cli \
    && chown -R node:node /home/node

# Switch back to the default user
USER node
