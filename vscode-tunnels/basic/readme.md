# Basic container

from docker hub [optiwariindia/vscode-tunnel](https://hub.docker.com/r/optiwariindia/vscode-tunnel)

## how to build and run example

```
docker build -t vscode-tunnel .
docker run -d -v /path/to/sourcecode:/home/node/workspace --name vscode-tunnel-server optiwariindia/vscode-tunnel
```

## How to get the logs

```
docker logs vscode-tunnel-server
```