#!/bin/bash
multipass stop salt-master
multipass delete salt-master
multipass stop salt-minion1
multipass delete salt-minion1
multipass stop salt-minion2
multipass delete salt-minion2
multipass stop salt-minion3
multipass delete salt-minion3
multipass purge

