#!/bin/sh
ansible-playbook k8s_multipass_full_setup.yml -e cluster_name=mycluster
ansible-playbook -i k8s_dynamic_inventory.ini k8s_multipass_full_setup.yml
