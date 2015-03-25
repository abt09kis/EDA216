-- Delete the tables if they exist. Set foreign_key_checks = 0 to
-- disable foreign key checks, so the tables may be dropped in
-- arbitrary order.
set foreign_key_checks = 0;
drop table if exists Ingredients;
drop table if exists Recipes;
drop table if exists Cookies;
drop table if exists Pallets;
drop table if exists Orders;
drop table if exists CustomerOrders;
drop table if exists Customers;
drop table if exists PalletsInOrders;

-- Create the tables.
create table Ingredients (
ingredientName varchar(30) not null,
quantity integer not null,
storageDate date not null,
lastDeliveredQuantity integer not null,
primary key(ingredientName)
);
create table Cookies (
cookieName varchar(30)  not null,
primary key(cookieName)
);
create table Recipes (
cookieName varchar(30) not null,
ingredientName varchar(30) not null,
quantity integer not null,
primary key(cookieName),
foreign key(cookieName) references Cookies(cookieName),
foreign key(ingredientName) references Ingredients(ingredientName)
);
create table Pallets (
palletNbr integer auto_increment,
cookieName varchar(30) not null,
prodTime date not null,
blocked varchar(5) not null,
delivered varchar(5) not null,
primary key(palletNbr),
foreign key(cookieName) references Cookies(cookieName)
);
create table Customers  (
customerId integer auto_increment,
adress varchar(30) not null,
customerName varchar(30) not null,
primary key(customerID)
);
create table Orders  (
orderNbr integer auto_increment,
nbrPallet integer not null,
orderDate date not null,
customerId integer not null,
primary key(orderNbr),
foreign key(customerId) references Customers(customerId)
);
create table PalletsInOrders  (
orderNbr integer not null,
palletNbr integer not null,
primary key(palletNbr),
foreign key(orderNbr) references Orders(orderNbr),
foreign key(palletNbr) references Pallets(palletNbr)
);
create table CustomerOrders  (
customerId integer not null,
orderNbr integer not null,
primary key(customerId,orderNbr),
foreign key(orderNbr) references Orders(orderNbr),
foreign key(customerId) references Customers(customerId)
);

set foreign_key_checks = 1;
