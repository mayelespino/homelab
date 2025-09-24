#!/bin/bash
# Salt Stack Environment Management Script

SALT_MASTER_IP="10.153.17.123"
SSH_KEY="/home/mayel/.ssh/multipass_key"

case "$1" in
  start)
    echo "Starting all Salt VMs..."
    multipass start salt-master salt-minion-01 salt-minion-02 salt-minion-03
    ;;
  stop)
    echo "Stopping all Salt VMs..."
    multipass stop salt-master salt-minion-01 salt-minion-02 salt-minion-03
    ;;
  delete)
    echo "Deleting all Salt VMs..."
    multipass delete salt-master salt-minion-01 salt-minion-02 salt-minion-03
    multipass purge
    ;;
  status)
    multipass list
    echo ""
    echo "Salt Master IP: $SALT_MASTER_IP"
    ;;
  ssh)
    if [ -z "$2" ]; then
      echo "Usage: $0 ssh <vm_name>"
      echo "Available VMs:"
      echo "  - salt-master"
      echo "  - salt-minion-01"
      echo "  - salt-minion-02"
      echo "  - salt-minion-03"
    else
      ssh -i "$SSH_KEY" -o StrictHostKeyChecking=no ubuntu@$(multipass info $2 --format json | jq -r '.info."'$2'".ipv4[0]')
    fi
    ;;
  salt-status)
    echo "Checking Salt Stack status..."
    ssh -i "$SSH_KEY" -o StrictHostKeyChecking=no ubuntu@$SALT_MASTER_IP "sudo salt-key -L"
    ;;
  test-salt)
    echo "Testing Salt connectivity..."
    ssh -i "$SSH_KEY" -o StrictHostKeyChecking=no ubuntu@$SALT_MASTER_IP "sudo salt '*' test.ping"
    ;;
  salt-cmd)
    if [ -z "$2" ]; then
      echo "Usage: $0 salt-cmd '<salt command>'"
      echo "Example: $0 salt-cmd 'grains.items'"
    else
      ssh -i "$SSH_KEY" -o StrictHostKeyChecking=no ubuntu@$SALT_MASTER_IP "sudo salt '*' $2"
    fi
    ;;
  apply-states)
    echo "Applying Salt states to all minions..."
    ssh -i "$SSH_KEY" -o StrictHostKeyChecking=no ubuntu@$SALT_MASTER_IP "sudo salt '*' state.apply"
    ;;
  *)
    echo "Usage: $0 {start|stop|delete|status|ssh <vm_name>|salt-status|test-salt|salt-cmd '<command>'|apply-states}"
    echo ""
    echo "Salt-specific commands:"
    echo "  salt-status  - Show accepted/rejected minion keys"
    echo "  test-salt    - Test connectivity to all minions"
    echo "  salt-cmd     - Run salt command on all minions"
    echo "  apply-states - Apply all Salt states"
    exit 1
    ;;
esac
