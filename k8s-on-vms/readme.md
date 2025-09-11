#!/bin/bash
# Kubernetes Cluster Setup Script
# Run this script to deploy your Kubernetes cluster

echo "Kubernetes Cluster Setup Instructions"
echo "====================================="

# Prerequisites check
echo "1. Prerequisites Setup"
echo "   - Ensure all VMs are running Ubuntu 20.04+ or 22.04+"
echo "   - Update inventory.ini with your actual VM IP addresses"
echo "   - Ensure SSH key-based authentication is set up"
echo "   - Make sure you can SSH to all VMs without password"

echo ""
echo "2. File Structure"
echo "   Create the following files in your working directory:"
echo "   - k8s-cluster-setup.yml (main playbook)"
echo "   - inventory.ini (inventory file)"
echo "   - ansible.cfg (configuration file)"

echo ""
echo "3. Update Inventory File"
echo "   Edit inventory.ini and replace the example IP addresses with your actual VM IPs:"
echo "   [master]"
echo "   k8s-master ansible_host=YOUR_MASTER_IP"
echo "   [workers]"
echo "   k8s-worker-1 ansible_host=YOUR_WORKER1_IP"
echo "   k8s-worker-2 ansible_host=YOUR_WORKER2_IP"
echo "   k8s-worker-3 ansible_host=YOUR_WORKER3_IP"

echo ""
echo "4. Test Connectivity"
echo "   Run: ansible all -m ping"

echo ""
echo "5. Deploy Kubernetes Cluster"
echo "   Run: ansible-playbook k8s-cluster-setup.yml"

echo ""
echo "6. Verify Installation"
echo "   SSH to master node and run:"
echo "   kubectl get nodes"
echo "   kubectl get pods -A"

echo ""
echo "7. Additional Commands"
echo ""

# Test connectivity
echo "# Test connectivity to all nodes"
echo "ansible all -m ping"
echo ""

# Run the playbook
echo "# Deploy the Kubernetes cluster"
echo "ansible-playbook k8s-cluster-setup.yml"
echo ""

# Verify cluster
echo "# Verify cluster status (run on master node)"
echo "kubectl get nodes -o wide"
echo "kubectl get pods -n kube-system"
echo "kubectl cluster-info"
echo ""

# Deploy test application
echo "# Deploy a test nginx application"
echo "kubectl create deployment nginx --image=nginx"
echo "kubectl expose deployment nginx --port=80 --type=NodePort"
echo "kubectl get services"
echo ""

# Troubleshooting commands
echo "# Troubleshooting commands"
echo "# Check logs on any node:"
echo "sudo journalctl -xeu kubelet"
echo ""
echo "# Reset a node if needed:"
echo "sudo kubeadm reset"
echo "sudo systemctl restart containerd kubelet"
echo ""
echo "# Check cluster component status:"
echo "kubectl get componentstatuses"
echo ""

echo "Network Configuration Notes:"
echo "==========================="
echo "- This playbook configures Flannel CNI with pod network CIDR 10.244.0.0/16"
echo "- Ensure your VM network doesn't conflict with this CIDR"
echo "- VMs should be able to communicate with each other on all required ports"
echo "- Required ports:"
echo "  Master node:"
echo "    - 6443 (Kubernetes API server)"
echo "    - 2379-2380 (etcd server client API)"
echo "    - 10250 (kubelet API)"
echo "    - 10251 (kube-scheduler)"
echo "    - 10252 (kube-controller-manager)"
echo "  Worker nodes:"
echo "    - 10250 (kubelet API)"
echo "    - 30000-32767 (NodePort services)"
echo ""

echo "Security Notes:"
echo "==============="
echo "- This setup uses kubeconfig with admin privileges"
echo "- For production, implement proper RBAC"
echo "- Consider using certificate-based authentication"
echo "- Regularly update Kubernetes and container runtime"
