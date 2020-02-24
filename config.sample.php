<?php

const DSN='mysql:dbname=memo;host=localhost;charset=utf8mb4';
const DBUSER='root';
const DBPASS='';

function connectDB() {
	return new PDO(DSN, DBUSER, DBPASS);
}
