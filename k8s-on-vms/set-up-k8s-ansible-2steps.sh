#!/bin/bash
set -euo pipefail

# Usage: ./deploy_k8s_multipass_cluster.sh <cluster_name>
# Example: ./deploy_k8s_multipass_cluster.sh mycluster

CLUSTER_NAME="${1:-}"
PLAYBOOK="k8s_multipass_full_setup.yml"
INVENTORY_FILE="${CLUSTER_NAME}_inventory.ini"

if [[ -z "$CLUSTER_NAME" ]]; then
  echo "Usage: $0 <cluster_name>"
  exit 1
fi

echo "=== [1/2] Provisioning VMs and generating inventory for cluster: $CLUSTER_NAME ==="
ansible-playbook -i localhost, "$PLAYBOOK" -e "cluster_name=$CLUSTER_NAME" --tags provision

echo
echo "=== [2/2] Installing Kubernetes cluster on VMs for cluster: $CLUSTER_NAME ==="
ansible-playbook -i "$INVENTORY_FILE" "$PLAYBOOK" -e "cluster_name=$CLUSTER_NAME" --tags cluster

echo
echo "=== Done! ==="
echo "To manage this cluster, use the k8s config on the master node: /root/.kube/config"
