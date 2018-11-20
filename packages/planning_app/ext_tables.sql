#
# Table structure for table 'tx_planningapp_domain_model_volunteer'
#
CREATE TABLE tx_planningapp_domain_model_volunteer (

	user int(11) DEFAULT '0' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	date_of_birth date DEFAULT NULL,

);

#
# Table structure for table 'tx_planningapp_domain_model_activity'
#
CREATE TABLE tx_planningapp_domain_model_activity (

	title varchar(255) DEFAULT '' NOT NULL,
	location int(11) unsigned DEFAULT '0',
	time_frames int(11) unsigned DEFAULT '0' NOT NULL,
	volunteers int(11) unsigned DEFAULT '0' NOT NULL,
	resources int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_planningapp_domain_model_dateperiod'
#
CREATE TABLE tx_planningapp_domain_model_dateperiod (

	activity int(11) unsigned DEFAULT '0' NOT NULL,

	start_time datetime DEFAULT NULL,
	end_time datetime DEFAULT NULL,

);

#
# Table structure for table 'tx_planningapp_domain_model_location'
#
CREATE TABLE tx_planningapp_domain_model_location (

	title varchar(255) DEFAULT '' NOT NULL,
	latitude double(11,2) DEFAULT '0.00' NOT NULL,
	longitude varchar(255) DEFAULT '' NOT NULL,
	address int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_planningapp_domain_model_address'
#
CREATE TABLE tx_planningapp_domain_model_address (

	street varchar(255) DEFAULT '' NOT NULL,
	number varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	country int(11) DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_planningapp_domain_model_resource'
#
CREATE TABLE tx_planningapp_domain_model_resource (

	title varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_planningapp_domain_model_dateperiod'
#
CREATE TABLE tx_planningapp_domain_model_dateperiod (

	activity int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_planningapp_activity_volunteer_mm'
#
CREATE TABLE tx_planningapp_activity_volunteer_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_planningapp_activity_resource_mm'
#
CREATE TABLE tx_planningapp_activity_resource_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
