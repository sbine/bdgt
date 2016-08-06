# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.network "private_network", ip: "192.168.33.30"
  config.vm.network "forwarded_port", guest: 22, host: 2233

  # config.vm.network "public_network"
  # config.ssh.forward_agent = true

  config.vm.synced_folder "./", "/var/www/bdgt", :mount_options => ["dmode=777","fmode=666"]

  config.vm.provider "virtualbox" do |vb|
    vb.name = "bdgt"
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

  config.vm.provision :shell, :path => "vagrant.sh"
end
