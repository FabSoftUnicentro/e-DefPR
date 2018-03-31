BRANCH=$(git symbolic-ref HEAD | sed -e 's,.*/\(.*\),\1,')
ISSUE=${BRANCH/issue#/}
GITHUB_REPOSITORY='https://api.github.com/repos/C3DSU/e-DefPR'

open_pull_request() {
	local head="C3DSU:$BRANCH"
	local base="master"
	local title="$BRANCH"
	local body="fixed #$ISSUE"

	echo 'Digite seu usuario do GitHub:'
	read USER
	echo 'Digite sua senha do Github ou token (https://github.com/settings/tokens/new):'
	read -s PASS

	LOGIN="$USER:$PASS"

	json="{\"head\":\"$head\",\"base\":\"$base\",\"title\":\"$title\",\"body\":\"$body\"}"
	echo $(curl -s -X POST -u $LOGIN -d "$json" $GITHUB_REPOSITORY/pulls)
}

get_pull_request_number() {
	read x
	echo $x | grep \"number\" | grep -oP '(?<="number": ).*(?=, "state")'
}

echo 'Criando Pull Request no GitHub...'
pr=$(open_pull_request | get_pull_request_number)

if [[ -z $pr ]]; then
	echo 'Erro: Pull Request nao foi criada'
    exit 1
else
    echo 'Sucesso: https://github.com/C3DSU/e-DefPR/pull/$pr/files'
fi