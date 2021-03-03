/********************************
   Assignment 5
   Author: James Johnston
   Created: 2/26/2021
  *******************************/
-- Need to establish what database we are using (moviestore)
USE moviestore;

-- 1. Display the firstName, lastName, and phone fields from the members table (List of Members).
SELECT firstName, lastName, phone FROM members;

-- 2. Display the title, year, and movieId fields for all those movies that are of Animation type.
SELECT title, year, movieID FROM movies WHERE type = 'Animation';

-- 3. Display the title, year, and movie_Id fields for all those movies that are of Sci-Fi type.
SELECT title, year, movieID FROM movies WHERE type = 'Sci-Fi';

-- 4. Display the title, type, and dateOut fields for all those movies checked out before 2017-12-31.
SELECT m.title, m.type, r.dateOut FROM rentals r INNER JOIN movies m ON m.movieID = r.movieID WHERE r.dateOut < '2017-12-31';

-- 5. Display the title, type, and dateOut fields for all those movies checked out after 2017-12-31 that are Sci-Fi movies.
SELECT m.title, m.type, r.dateOut FROM rentals r INNER JOIN movies m ON m.movieID = r.movieID WHERE r.dateOut > '2017-12-31' AND m.type = 'Sci-Fi';

-- 6. Display the title, type, and year fields for all those Drama type movies released between 2010 and 2019.
SELECT title, type, year FROM movies WHERE type = 'Drama' AND year BETWEEN '2010' AND '2019';

-- 7. Display the firstName, lastName, title, type, and year fields for all the movies checked out by members.
SELECT mb.firstName, mb.lastName, mv.title, mv.type, mv.year FROM members mb LEFT JOIN rentals r USING(memberID) INNER JOIN movies mv ON (r.movieID = mv.movieID) ORDER BY mb.memberID ASC;

-- 8. Display the firstName, lastName, title, type, and year fields for all those Drama or Adventure type movies checked out by members.
SELECT mb.firstName, mb.lastName, mv.title, mv.type, mv.year FROM members mb LEFT JOIN rentals r USING(memberID) INNER JOIN movies mv ON (r.movieID = mv.movieID) WHERE mv.type = 'Drama' OR mv.type = 'Adventure' ORDER BY mb.memberID ASC;

-- 9. Display the firstName, lastName, title, type, and year fields for all those Sci-Fi type movies checked out by the member identified by the memberId number 5.
SELECT mb.firstName, mb.lastName, mv.title, mv.type, mv.year FROM members mb LEFT JOIN rentals r USING(memberID) INNER JOIN movies mv ON (r.movieID = mv.movieID) WHERE mv.type = 'Sci-Fi' AND mb.memberID = 5;

-- 10. Display the firstName, lastName, title, type,  year, and dateOut fields for all those Drama type movies checked out by members after 2019-12-01.
SELECT mb.firstName, mb.lastName, mv.title, mv.type, mv.year, r.dateOut FROM members mb LEFT JOIN rentals r USING(memberID) INNER JOIN movies mv ON (r.movieID = mv.movieID) WHERE mv.type = 'Drama' AND r.dateOut > '2019-12-01';
