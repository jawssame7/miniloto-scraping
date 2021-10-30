#!/bin/bash
# srcファイルをrsync over SSHで転送
rsync -acvz --delete -e "ssh -i key -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no" ./ web@ik1-344-32290.vs.sakura.ne.jp:/home/web/workspace/miniloto/
# サービスを再起動
ssh web@ik1-344-32290.vs.sakura.ne.jp "cd /home/web/workspace/miniloto/; sudo docker-compose build; sudo docker-compose down; sudo docker-compose up -d"
