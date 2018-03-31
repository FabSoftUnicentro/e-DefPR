# Branch Master
git checkout master
git fetch origin
git pull origin master

# Branch Issue
if [[ -n $(git branch | grep issue#$1) ]]; then
	git checkout issue#$1
	git pull origin master
	git push --set-upstream origin issue#$1
else
	git checkout -b issue-#$1
	git push --set-upstream origin issue#$1
fi

echo "Tudo pronto, agora no branch: issue#$1"
