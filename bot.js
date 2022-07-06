const mysql = require('mysql');
const connection = mysql.createConnection({
    host: 'localhost',
    user: "root",
    password: '',
    database: 'panel'
});

connection.connect(function(err) {
    if (err) {
        console.error('error connecting: ' + err.stack);
        return;
    }

    console.log('connected as id ' + connection.threadId);
});
const roleId = 957808702847590421
setInterval(function(){
    connection.query(`SELECT * FROM users WHERE discord_id IS NULL AND added_role = false`, (err, result) => {
        const users = Object.values(JSON.stringify(result))
        Array.from(users).map(function(user){
            user.roles.add(roleId).catch()
            connection.query(`UPDATE users SET added_role = true WHERE discord_id = ? `, [user.id],function (err, result){
            })
        })
    })
}, 5000)
