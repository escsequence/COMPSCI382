/**
 * Assignment 11 (part 2)
 * COMPSCI382
 * James Johnston
 * 4/29/2021
 */

const express = require('express');
const app = express();
const port = 3000;
var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/";


// Default route
app.get('/', (req, res) => {
    res.write(`<!doctype html><html><head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
     integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"/>
     <style> .link-item { margin-right: 20px} </style>
     </head><body><div class="container-fluid">`);
    res.write(`<h2>Online Movie Store</h2>`);
    res.write(`<ul><li><a href="http://localhost:3000/movies">List of All Movies</a></li>`);
    res.write(`<li><a href="http://localhost:3000/latest">Latest Movies</a></li>`);
    res.write(`<li><a href="http://localhost:3000/movies/Action">Action Movies</a></li>`);
    res.write(`<li><a href="http://localhost:3000/movies/Adventure">Adventure Movies</a></li>`);
    res.write(`<li><a href="http://localhost:3000/movies/Drama">Drama Movies</a></li></ul>`);
    res.write("</div></body></html>");
    res.end();
});


app.get('/movies', (req, res) => {

    res.write(`<!doctype html><html><head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
     integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"/>
     <style> .link-item { margin-right: 20px} </style>
     </head><body><div class="container-fluid">`);

    res.write(`<h2>Online Movie Store</h2>`);
    res.write(`<p><span class="link-item"><a href="http://localhost:3000/">Home</a></span>`);
    res.write(`<span class="link-item"><a href="http://localhost:3000/latest">Latest Movies</a></span>`);
    res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Action">Action Movies</a></span>`);
    res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Adventure">Adventure Movies</a></span>`);
    res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Drama">Drama Movies</a></span></p>`);
  // Display a list of all the courses

    // Connect to the MongoDB server
    const client = new MongoClient(url,  { useUnifiedTopology: true });
    client.connect(function(err) {
    if (err) throw err;
  const dbo = client.db("moviestoreDB");

// Fetch a list of all the courses
  dbo.collection("movies").find({}).toArray( (err, movies) => {
        if (err) throw err;
      if (movies.length) {
        res.write(`<h4>List of All Movies</h4>`);
        res.write(`<table class="table">`)
        res.write(`<tr><th>Title</th><th>Year</th><th>Genre</th></tr>`);
        movies.forEach(r => {
          res.write(`<tr><td>${r.title}</td><td>${r.year}</td><td>${r.type}</td></tr>`);
        });
        res.write("</table></div></body></html>")
      }
        client.close(); // close database connection
        res.end(); // end response
    });
  });
});


// Define a route to handle GET requests beginning with '/courses'
app.get('/movies/:type', (req, res) => {
    // Display a list of courses matching the given 'subject'
  res.write(`<!doctype html><html><head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
   integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"/>
   <style> .link-item { margin-right: 20px} </style>
   </head><body><div class="container-fluid">`);

  res.write(`<h2>Online Movie Store</h2>`);
  res.write(`<p><span class="link-item"><a href="http://localhost:3000/">Home</a></span>`);
  res.write(`<span class="link-item"><a href="http://localhost:3000/latest">Latest Movies</a></span>`);
  res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Action">Action Movies</a></span>`);
  res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Adventure">Adventure Movies</a></span>`);
  res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Drama">Drama Movies</a></span></p>`);

    // Read route parameter
    const selectedGenre = req.params.type

    // Connect to the MongoDB server
    const client = new MongoClient(url,  { useUnifiedTopology: true });
    client.connect(function(err) {
    if (err) throw err;
    var dbo = client.db("moviestoreDB");

    dbo.collection("movies").find({type: selectedGenre}).toArray( (err, movies) => {
        if (err) throw err;
        if (movies.length) {
          res.write(`<h2>List of ` + selectedGenre + ` Movies</h2>`);

          res.write(`<table class="table">`)

          movies.forEach(r => {
          res.write(`<tr><td>${r.title}</td><td>${r.year}</td><td> ${r.type}</td></tr>`);
          });

          res.write("</table></div></body></html>")
        }
        client.close(); // close database connection
        res.end(); // end response
    });
  });
});

// Define a route to handle GET requests beginning with '/courses'
app.get('/latest', (req, res) => {
    // Display a list of courses matching the given 'subject'
  res.write(`<!doctype html><html><head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
   integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"/>
   <style> .link-item { margin-right: 20px} </style>
   </head><body><div class="container-fluid">`);

  res.write(`<h2>Online Movie Store</h2>`);
  res.write(`<p><span class="link-item"><a href="http://localhost:3000/">Home</a></span>`);
  res.write(`<span class="link-item"><a href="http://localhost:3000/latest">Latest Movies</a></span>`);
  res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Action">Action Movies</a></span>`);
  res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Adventure">Adventure Movies</a></span>`);
  res.write(`<span class="link-item"><a href="http://localhost:3000/movies/Drama">Drama Movies</a></span></p>`);

    // Read route parameter
    const selectedGenre = req.params.type

    // Connect to the MongoDB server
    const client = new MongoClient(url,  { useUnifiedTopology: true });
    client.connect(function(err) {
    if (err) throw err;
    var dbo = client.db("moviestoreDB");

    dbo.collection("movies").find({year: {"$gt": 2014}}).toArray( (err, movies) => {
        if (err) throw err;
        if (movies.length) {
          res.write(`<h2>Latest Movies</h2>`);

          res.write(`<table class="table">`)

          movies.forEach(r => {
          res.write(`<tr><td>${r.title}</td><td>${r.year}</td><td> ${r.type}</td></tr>`);
          });

          res.write("</table></div></body></html>")
        }
        client.close(); // close database connection
        res.end(); // end response
    });
  });
});

app.listen(port, () => console.log(`Example app listening at http://localhost:${port}`));
