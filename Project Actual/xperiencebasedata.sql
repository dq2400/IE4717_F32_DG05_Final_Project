use xperience_db;

insert into xperiencerun values
  (1, "2023-10-09", "2023-10-20", "08:00:00", "10:00:00", "12:00:00", "14:00:00", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10);
insert into logincredentials values
  ("admin", MD5("123"), "admin"),
  ("tohys005", MD5("1qaz"), "student"),
  ("kquek009", MD5("qwerty"), "student");
  
