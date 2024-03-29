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
primary key(cookieName,ingredientName),
foreign key(cookieName) references Cookies(cookieName),
foreign key(ingredientName) references Ingredients(ingredientName)
);
create table Pallets (
palletNbr integer auto_increment,
cookieName varchar(30) not null,
prodTime datetime not null,
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


insert into Ingredients values('Flour','1000000','2015-03-04','0');
insert into Ingredients values('Butter','1000000','2015-03-04','0');
insert into Ingredients values('Icing Sugar','1000000','2015-03-04','0');
insert into Ingredients values('Roasted, chopped nuts','1000000','2015-03-04','0');
insert into Ingredients values('Fine-ground nuts','1000000','2015-03-04','0');
insert into Ingredients values('Ground, roasted nuts','1000000','2015-03-04','0');
insert into Ingredients values('Bread crumbs','1000000','2015-03-04','0');
insert into Ingredients values('Sugar','1000000','2015-03-04','0');
insert into Ingredients values('Egg whites','1000000','2015-03-04','0');
insert into Ingredients values('Chocolate','1000000','2015-03-04','0');
insert into Ingredients values('Marzipan','1000000','2015-03-04','0');
insert into Ingredients values('Eggs','1000000','2015-03-04','0');
insert into Ingredients values('Potato starch','1000000','2015-03-04','0');
insert into Ingredients values('Wheat flour','1000000','2015-03-04','0');
insert into Ingredients values('Sodium bicarbonate','1000000','2015-03-04','0');
insert into Ingredients values('Vanilla','1000000','2015-03-04','0');
insert into Ingredients values('Chopped almonds','1000000','2015-03-04','0');
insert into Ingredients values('Cinnamon','1000000','2015-03-04','0');
insert into Ingredients values('Vanilla Sugar','1000000','2015-03-04','0');

insert into Cookies values('Nut ring');
insert into Cookies values('Nut cookie');
insert into Cookies values('Amneris');
insert into Cookies values('Tango');
insert into Cookies values('Almond delight');
insert into Cookies values('Berliner');

insert into Recipes values('Nut ring', 'Flour','450');
insert into Recipes values('Nut ring', 'Butter','450');
insert into Recipes values('Nut ring', 'Icing sugar','190');
insert into Recipes values('Nut ring', 'Roasted, chopped nuts', '225');

insert into Recipes values('Nut cookie','Fine-ground nuts','750');
insert into Recipes values('Nut cookie','Ground, roasted nuts','625');
insert into Recipes values('Nut cookie','Bread crumbs','125');
insert into Recipes values('Nut cookie','Sugar','375');
insert into Recipes values('Nut cookie','Egg whites','350');
insert into Recipes values('Nut cookie','Chocolate','50');

insert into Recipes values('Amneris','Marzipan','750');
insert into Recipes values('Amneris','Butter','250');
insert into Recipes values('Amneris','Eggs','250');
insert into Recipes values('Amneris','Potato starch','25');
insert into Recipes values('Amneris','Wheat flour','25');

insert into Recipes values('Tango','Butter','200');
insert into Recipes values('Tango','Sugar','250');
insert into Recipes values('Tango','Flour','300');
insert into Recipes values('Tango','Sodium bicarbonate','4');
insert into Recipes values('Tango','Vanilla','2');

insert into Recipes values('Almond delight','Butter','400');
insert into Recipes values('Almond delight','Sugar','270');
insert into Recipes values('Almond delight','Chopped almonds','279');
insert into Recipes values('Almond delight','Flour','400');
insert into Recipes values('Almond delight','Cinnamon','10');

insert into Recipes values('Berliner','Flour','350');
insert into Recipes values('Berliner','Butter','250');
insert into Recipes values('Berliner','Icing sugar','100');
insert into Recipes values('Berliner','Eggs','50');
insert into Recipes values('Berliner','Vanilla Sugar','5');
insert into Recipes values('Berliner','Chocolate','50');

insert into Customers values(customerId,'Helsingborg','Finkakor AB');
insert into Customers values(customerId,'Malmö','Småbröd AB');
insert into Customers values(customerId,'Landskrona','Kaffebröd AB');
insert into Customers values(customerId,'Ystad','Bjudkakor AB');
insert into Customers values(customerId,'Trelleborg','Kalaskakor AB');
insert into Customers values(customerId,'Kristianstad','Partykakor AB');
insert into Customers values(customerId,'Hässleholm','Gästkakor AB');
insert into Customers values(customerId,'Perstorp','Skånekakor AB');



