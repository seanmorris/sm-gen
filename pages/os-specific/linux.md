# Linux Specific Stuff

## Debian

Installing the dependencies on debian and friends is simple. All but `YQ` are available from the default repositories:

```bash
apt install php php-yaml bash pandoc uuid inotify-tools

YQ_VERSION=v4.47.2
wget -qO /usr/local/bin/yq https://github.com/mikefarah/yq/releases/download/${YQ_VERSION}/yq_linux_amd64
chmod +x /usr/local/bin/yq
```