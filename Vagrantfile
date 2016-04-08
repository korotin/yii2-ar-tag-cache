# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.configure(2) do |config|
  config.vm.box = "herroffizier/php7"

  config.vm.provision "shell", inline: <<-SHELL
    mysqladmin create test
  SHELL
end
