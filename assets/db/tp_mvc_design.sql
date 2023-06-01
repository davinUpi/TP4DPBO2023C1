create table members (
    member_id bigint primary key auto_increment,
    member_name varchar(50) not null,
    member_email varchar(50) unique,
    member_phone varchar(20) unique,
    member_uni bigint not null,
    member_join_date date default CURDATE(),

    foreign key(member_uni) references universities(uni_id) on delete cascade
);

create table universities(
    uni_id bigint primary key auto_increment,
    uni_name varchar(25) unique,
    uni_city varchar(30) not null,
    uni_members int default 0
);

delimiter $$
create trigger add_member
after insert on members
for each ROW
begin
    update universities as A
    set uni_members = uni_members + 1
    where A.uni_id = NEW.member_uni;
end$$
delimiter ;

delimiter $$
create trigger sub_member
after delete on members
for each row
begin
    update universities as A
    set uni_members = uni_members - 1
    where A.uni_id = OLD.member_uni;
end$$
delimiter ;