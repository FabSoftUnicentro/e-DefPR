var githubhook = require('githubhook')
var github = githubhook({})

const { exec } = require('child_process')

github.listen()

github.on('pull_request:e-DefPR', function (ref, data) {
  if (data.action === 'opened') {
    const url = data.pull_request.html_url
    const message = '@here REVIEW: ' + url + '/files'

    exec('edef-slack-notify --review "' + message + '"', (err, stdout, stderr) => {
      if (err) {
        return
      }
    })
  }

  if (data.action === 'closed' && data.pull_request.merged) {
    exec('cd $EDEF_PATH/devops && dep deploy', (err, stdout, stderr) => {
      if (err) {
        return
      }
    })
  }
})
