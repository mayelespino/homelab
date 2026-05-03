FROM optiwariindia/vscode-tunnel:latest

USER root

# Install build dependencies
RUN apt-get update && apt-get install -y \
    wget \
    build-essential \
    libssl-dev \
    zlib1g-dev \
    libbz2-dev \
    libreadline-dev \
    libsqlite3-dev \
    libffi-dev \
    liblzma-dev \
    libncurses5-dev \
    libgdbm-dev \
    libnss3-dev \
    curl \
    sudo \
    python3-pip \
    && rm -rf /var/lib/apt/lists/*

# Install pyenv into a shared location accessible by all users
ENV PYENV_ROOT="/usr/local/pyenv"
ENV PATH="$PYENV_ROOT/bin:$PYENV_ROOT/shims:$PATH"

RUN curl https://pyenv.run | bash

# Install the latest stable Python version
RUN pyenv install $(pyenv install --list | grep -E "^\s+[0-9]+\.[0-9]+\.[0-9]+$" | tail -1 | tr -d ' ') \
    && pyenv global $(pyenv install --list | grep -E "^\s+[0-9]+\.[0-9]+\.[0-9]+$" | tail -1 | tr -d ' ')

# Upgrade pip
RUN pip install --upgrade pip

# Grant node user passwordless sudo and make pyenv available to them
RUN echo "node ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers \
    && echo 'export PYENV_ROOT="/usr/local/pyenv"' >> /home/node/.bashrc \
    && echo 'export PATH="$PYENV_ROOT/bin:$PYENV_ROOT/shims:$PATH"' >> /home/node/.bashrc \
    && echo 'export PYENV_ROOT="/usr/local/pyenv"' >> /home/node/.profile \
    && echo 'export PATH="$PYENV_ROOT/bin:$PYENV_ROOT/shims:$PATH"' >> /home/node/.profile \
    && chown -R node:node /usr/local/pyenv

# Switch back to the default user
USER node