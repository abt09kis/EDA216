-- Delete the tables if they exist. Set foreign_key_checks = 0 to
-- disable foreign key checks, so the tables may be dropped in
-- arbitrary order.
set foreign_key_checks = 0;
drop table if exists Users;
drop table if exists Movies;
drop table if exists Theaters;
drop table if exists Tickets;
drop table if exists Performances;
set foreign_key_checks = 1;
-- Create the tables.
create table Users (
userName varchar(15) not null,
name varchar(30) not null,
phoneNbr varchar(13) not null,
adress varchar(100),
primary key(userName)
);
Create table Theaters(
theaterName varchar(50) not null,
nbrSeats Integer not null,
primary key(theaterName)
);
Create table Movies(
movieName varchar(50) not null,
primary key(movieName)
);
Create table Performances(
movieName varchar(30) not null,
theaterName varchar(50) not null,
freeSeats integer not null,
perfDate date not null,
primary key(movieName, perfDate),
foreign key(theaterName) references Theaters(theaterName)
);
Create table Tickets(
resNbr integer auto_increment,
userName varchar(15) not null,
movieName varChar(50) not null,
perfDate date not null,
primary key(resNbr),
foreign key(userName) references Users(userName),
foreign key(movieName,perfDate) references Performances(movieName,perfDate)
);
-- Insert data into the tables.
insert into Users values('Pelle','Per Ahlbom','0702615439','Magistratsvägen');
insert into Users values('Käv','Kevin Lindblad','0735038344', 'Kämnärsvägen');
insert into Movies values('Jupiter Ascending');
insert into Movies values('Natt på museet');
insert into Movies values('Project Almanac');
insert into Movies values('Star Wars');
insert into Movies values('Spindelmannen');
insert into Theaters values('Royal',500);
insert into Theaters values('Bio Palatset',400);
insert into Performances values('Jupiter Ascending', 'Bio Palatset', 399,'2015-02-15');
insert into Performances values('Natt på museet','Royal', 499, '2015-02-15');
insert into Performances values('Project Almanac', 'Bio Palatset',399,'2015-02-16');
insert into Performances values('Star Wars','Royal',499,'1977-05-25');
insert into Performances values('Spindelmannen', 'Bio Palatset',399,'2002-06-23');
insert into Performances values('Spindelmannen', 'Bio Palatset',1,'2002-06-24');
insert into Tickets values(resNbr,'Pelle', 'Star Wars','1977-05-25');
insert into Tickets values(resNbr,'Käv', 'Spindelmannen','2002-06-23');
insert into Tickets values(resNbr,'Pelle', 'Jupiter Ascending','2015-02-15');
insert into Tickets values(resNbr,'Käv', 'Project Almanac','2015-02-16');
insert into Tickets values(resNbr,'Pelle', 'Natt på museet','2015-02-15');
