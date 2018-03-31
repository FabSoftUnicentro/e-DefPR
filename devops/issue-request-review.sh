BRANCH=$(git symbolic-ref HEAD | sed -e 's,.*/\(.*\),\1,')
ISSUE=${BRANCH/issue-#/}
GITHUB_REPOSITORY='https://api.github.com/repos/C3DSU/e-DefPR'

head="C3DSU:$BRANCH"
base="master"
title="$BRANCH"
body="fixed #$ISSUE"

echo 'Digite seu usuario do GitHub:'
read USER
echo 'Digite sua senha do Github ou token (https://github.com/settings/tokens/new):'
read -s PASS

LOGIN="$USER:$PASS"

json="{\"head\":\"$head\",\"base\":\"$base\",\"title\":\"$title\",\"body\":\"$body\"}"
echo $(curl -s -X POST -u $LOGIN -d "$json" $GITHUB_REPOSITORY/pulls)