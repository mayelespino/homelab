# How to use the compose.yml file

```
docker-compose up -d          # build + start in background
docker logs vscode-tunnel-server   # get the GitHub auth code
docker-compose down           # stop and remove
docker-compose up -d --build  # rebuild (e.g. after Dockerfile changes)
```

# How to authenticate to use the tunnel

```
docker logs vscode-tunnel-golang
```