create table blog_post(
pID serial PRIMARY KEY,
pTitle varchar(255) NOT NULL,
pDesc text NOT NULL,
pCont text NOT NULL,
pDate date NOT NULL,
mid int);
CREATE TABLE

create table blog_members(
mID serial PRIMARY KEY,
username varchar(255) NOT NULL,
password varchar(255) NOT NULL,
email varchar(255) NOT NULL,
verify boolean DEFAULT false);
CREATE TABLE

alter table blog_post add foreign key (mid) references blog_members(mid);
ALTER TABLE

alter table blog_members add column reset boolean default false;
ALTER TABLE

