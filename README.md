# Homelab

A monorepo collecting the projects, automation, and services running on my home lab — a mix of Raspberry Pi nodes, Multipass VMs, and self-hosted infrastructure.

Individual projects are pulled in as **git subtrees**, so they appear here as regular folders while continuing to live in their own upstream repositories.

## Projects

| Directory | Description | Upstream |
|-----------|-------------|----------|
| `bookmarks-pi/` | Self-hosted bookmarks dashboard page served from a Raspberry Pi | [bookmarks-pi](https://github.com/mayelespino/bookmarks-pi) |
| `gate-pi/` | Raspberry Pi gate controller with Telegram bot integration (`gate.local`) | [gate-pi](https://github.com/mayelespino/gate-pi) |
| `k8s-on-vms/` | Kubernetes cluster automation on Multipass VMs (1 master + 3 workers, containerd CRI) | [k8s-on-vms](https://github.com/mayelespino/k8s-on-vms) |
| `salt-on-vms/` | SaltStack infrastructure on Multipass VMs, provisioned with Ansible, including backup/restore automation | [salt-on-vms](https://github.com/mayelespino/salt-on-vms) |
| `sensor-pi/` | Raspberry Pi sensor node with dashboard integration | [sensor-pi](https://github.com/mayelespino/sensor-pi) |
| `speaker-pi/` | Raspberry Pi audio/speaker controller | [speaker-pi](https://github.com/mayelespino/speaker-pi) |
| `telegram-bot/` | Telegram bot service for homelab notifications and control | [telegram-bot](https://github.com/mayelespino/telegram-bot) |
| `vscode-tunnels/` | VS Code remote tunnel setup for accessing homelab machines | [vscode-tunnels](https://github.com/mayelespino/vscode-tunnels) |

## Infrastructure Overview

- **Hardware:** Multiple Raspberry Pi nodes (gate.local, chaperon.local, and others)
- **Virtualization:** Multipass VMs on Ubuntu for Kubernetes and SaltStack experimentation
- **Configuration management:** Ansible playbooks for provisioning, backup/restore, and network scanning
- **Orchestration:** Kubernetes cluster automation (1 master + 3 workers, containerd CRI)
- **Services:** systemd units for Telegram bots and Pinggy SSH tunnels
- **Dashboard:** PHP-based homelab dashboard (index, speaker, sensor, and bookmarks pages)
- **Containers:** Docker images published to [Docker Hub](https://hub.docker.com/u/mayelespino)

## Working With Subtrees

Each project folder was added with `git subtree`. Clones of this repo need **no special steps** — the folders are plain tracked files.

### Add a new project

```bash
git subtree add --prefix=<folder> git@github.com:mayelespino/<repo>.git main --squash
```

### Pull upstream changes into this repo

```bash
git subtree pull --prefix=gate-pi git@github.com:mayelespino/gate-pi.git main --squash
```

### Push local changes back upstream

```bash
git subtree push --prefix=gate-pi git@github.com:mayelespino/gate-pi.git main
```

**Tip:** use the SSH (`git@github.com:`) URLs — GitHub no longer accepts password authentication over HTTPS.

## Repo Layout

```
homelab/
├── bookmarks-pi/     # subtree: bookmarks dashboard
├── gate-pi/          # subtree: gate controller
├── k8s-on-vms/       # subtree: Kubernetes on Multipass VMs
├── salt-on-vms/      # subtree: SaltStack on Multipass VMs
├── sensor-pi/        # subtree: sensor node
├── speaker-pi/       # subtree: speaker controller
├── telegram-bot/     # subtree: Telegram bot service
├── vscode-tunnels/   # subtree: VS Code remote tunnels
└── README.md
```

## License

See the individual project directories for their respective licenses.

---

*Maintained by [Mayel Espino](https://mayel.tech) · [GitHub](https://github.com/mayelespino)*
