var fs    = require('fs');
var tasks = fs.readdirSync('./gulp/tasks/');

tasks = tasks.map(function(task){
  return './tasks/' + task
})

if (process.env.NODE_ENV == 'production'){
  tasks = tasks.concat(['./env/prod.js'])
} else {
  tasks = tasks.concat(['./env/dev.js'])
}

tasks.forEach(function(task) {
  require(task);
});