#!/bin/bash
# srcファイルをrsync over SSHで転送
rsync -acvz --delete -e "ssh -i key -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no" ./ web@ik1-344-32290.vs.sakura.ne.jp:/home/web/miniloto/
# サービスを再起動
# ssh web@ik1-344-32290.vs.sakura.ne.jp "cd miniloto-scraping/; docker-compose build; docker-compose down; docker-compose -f docker-compose.yml -f docker-compose-prod.yml up -d"
