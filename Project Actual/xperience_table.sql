create table enquirydata
( 	EnquiryIndex int unsigned not null auto_increment key,
	EnquiryDateTime datetime not null,
	Name char(30) not null,
	Email char(50) not null,
	EnquiryType char(20) not null,
	Enquiry text not null
);

create table logincredentials
( 	userName text not null,
	userPass text not null,
	rights char(10) not null 
);

create table participantsbooking
(  	run_number int not null,
	loginid text not null,
	emailid text not null,
	dateslot date not null,
	timeslot int unsigned not null
);

create table xperiencerun
( 	run_number int not null auto_increment key,
	start_date date not null,
	end_date date not null,
	session1_start time not null,
	session1_end time not null,
	session2_start time,
	session2_end time,
	session3_start time,
	session3_end time,
	session4_start time,
	session4_end time,
	session5_start time,
	session5_end time,
	session6_start time,
	session6_end time,
	maxslotpersession int not null
);
