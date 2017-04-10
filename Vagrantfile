# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
    config.vm.box = "sternpunkt/jimmybox"
    config.vm.synced_folder ".", "/home/vagrant/tdd-seed"
    config.vm.provision "shell",
    inline: "apt-get update -qq && DEBIAN_FRONTEND=noninteractive apt-get install -yq --no-install-recommends php-xdebug"
    config.ssh.extra_args = ["-t", "cd /home/vagrant/tdd-seed; bash --login"]
end
