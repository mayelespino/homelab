# Homelab

A monorepo collecting the projects, automation, and services running on my home lab — a mix of Raspberry Pi nodes, Multipass VMs, and self-hosted infrastructure.

Individual projects are pulled in as **git subtrees**, so they appear here as regular folders while continuing to live in their own upstream repositories.

## Projects

| Directory | Description | Upstream |
|-----------|-------------|----------|
| `gate-pi/` | Raspberry Pi gate controller with Telegram bot integration (`gate.local`) | [Gate-pi](https://github.com/mayelespino/Gate-pi) |
| `speaker-pi/` | Raspberry Pi audio/speaker controller | [Speaker-pi](https://github.com/mayelespino/Speaker-pi) |
| `sensor-pi/` | Raspberry Pi sensor node with dashboard integration | [Sensor-pi](https://github.com/mayelespino/Sensor-pi) |
| `chaperon/` | Safety check-in Telegram bot, containerized and running via supervisord in Docker (`chaperon.local`) | [Chaperon](https://github.com/mayelespino/Chaperon) |

> Adjust this table to match the subtrees actually present in the repo.

## Infrastructure Overview

- **Hardware:** Multiple Raspberry Pi nodes (gate.local, chaperon.local, and others)
- **Virtualization:** Multipass VMs on Ubuntu for Kubernetes and SaltStack experimentation
- **Configuration management:** Ansible playbooks for provisioning, backup/restore, and network scanning (arp-scan over 192.168.12.0/24)
- **Orchestration:** Kubernetes cluster automation (1 master + 3 workers, containerd CRI)
- **Services:** systemd units for Telegram bots (`telegram-gate.service`, `telegram-bot.service`) and Pinggy SSH tunnels
- **Dashboard:** PHP-based homelab dashboard (index, speaker, sensor, and bookmarks pages)
- **Containers:** Docker images published to [Docker Hub](https://hub.docker.com/u/mayelespino)

## Working With Subtrees

Each project folder was added with `git subtree`. Clones of this repo need **no special steps** — the folders are plain tracked files.

### Add a new project

```bash
git subtree add --prefix=<folder> git@github.com:mayelespino/<Repo>.git main --squash
```

### Pull upstream changes into this repo

```bash
git subtree pull --prefix=gate-pi git@github.com:mayelespino/Gate-pi.git main --squash
```

### Push local changes back upstream

```bash
git subtree push --prefix=gate-pi git@github.com:mayelespino/Gate-pi.git main
```

**Tip:** use the SSH (`git@github.com:`) URLs — GitHub no longer accepts password authentication over HTTPS.

## Repo Layout

```
homelab/
├── gate-pi/        # subtree: gate controller
├── speaker-pi/     # subtree: speaker controller
├── sensor-pi/      # subtree: sensor node
├── chaperon/       # subtree: check-in bot
├── ansible/        # playbooks,
