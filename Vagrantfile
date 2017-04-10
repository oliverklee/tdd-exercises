# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
    config.vm.box = "rasmus/php7dev"
    config.vm.synced_folder ".", "/home/vagrant/tdd-seed"
    config.vm.provision "shell", inline: "newphp 70"
end
