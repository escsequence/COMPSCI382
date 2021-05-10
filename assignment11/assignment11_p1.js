/**
 * Assignment 11 (part 1)
 * COMPSCI382
 * James Johnston
 * 4/29/2021
 */

// Connect to MongoDB
const MongoClient = require('mongodb').MongoClient;
const url = "mongodb://localhost:27017/";
const client = new MongoClient(url, { useUnifiedTopology: true });

// Connect to MySql database server
const mysql = require('mysql');

const mySqlConnection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'moviestore'
});
mySqlConnection.connect();
var querystring = "select title, type, year from `movies`";
mySqlConnection.query(querystring, [], (err, rows) => {
    if (err) throw err;
    if (rows.length) {
        courseList = rows;
        // Insert courses list into MongoDB
        insertRowsToMongoDB('movies', courseList);

        // Close MySql connection
        mySqlConnection.end();
    } else {
        console.log('There are no results');
    };
});


function insertRowsToMongoDB(collection, documentList) {
/* This method inserts a document list into a MongoDB collection.
    The first argument, 'collection', identifies the collection. */
  client.connect((err) => {
    if (err) throw err;
      // Change the database.
      const dbo = client.db('moviestoreDB');
      /* The above command uses the 'uwwDB' if it is already there.
         Otherwise, it creates a new database named 'uwwDB'
      */
     // Insert new documents into a collection identified by 'collection'
     dbo.collection(collection).insertMany(documentList).then(() =>{
        console.log("Added a new list of documents !");
        client.close();
     })
  });
}
