# How to use the compose.yml file

```
docker-compose up -d          # build + start in background
docker logs vscode-tunnel-server   # get the GitHub auth code
docker-compose down           # stop and remove
docker-compose up -d --build  # rebuild (e.g. after Dockerfile changes)
```

# How to authenticate to use the tunnel

```
docker logs vscode-tunnel-rust
```

you will get something like this:

```
[2026-03-15 05:21:42] info Using GitHub for authentication, run `code tunnel user login --provider <provider>` option to change this.
To grant access to the server, please log into https://github.com/login/device and use code E04F-1743
mayel@super2:/mnt/newdrive/GIT/homelab/vscode-tunnels/rust$ cp ../python/readme.md .
```