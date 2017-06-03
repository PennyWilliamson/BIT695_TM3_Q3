/* The code to create the new tables for the data base, assignment 2.
 */
CREATE TABLE players(
		MemberID int(30) NOT NULL AUTO_INCREMENT,
		FirstName varchar(25),
		FamilyName varchar(40),
		Email varchar(40),
		Phone varchar(20),
		PRIMARY KEY(MemberID),
		);

/*effectively leaderboard */		
CREATE TABLE board_games(
		MemberID int(30) NOT NULL,
		Boardgame varchar(60) NOT NULL,
		Position varchar(10) NOT NULL, /* varchar to allow = sign */
		Notes text,
		Date date NOT NULL,
		Event varchar NOT NULL(125),
		PRIMARY KEY (MemberID, Boardgame),
		FOREIGN KEY(MemberID) REFERENCES players(MemberID),
		);
		
CREATE TABLE library (
		MemberID int(30) NOT NULL,
		FirstName varchar(25) NOT NULL,
		Boardgame varchar(60) NOT NULL,
		Available varchar(20) NOT NULL,
		Notes text NOT NULL,
		PRIMARY KEY (MemberID),
		CREATE INDEX idx_library ON library(Boardgame),
		);
		
CREATE TABLE library_borrowers (
		MemberID int(30) NOT NULL,
		FirstName varchar(30) NOT NULL,
		borrowed varchar(125) NOT NULL,
		PRIMARY Key (MemberID),
		FOREIGN Key (MemberID) REFERENCES library(MemberID),
		CREATE INDEX idx_borrowers ON library_borrowers(FirstName),
		);
		
CREATE TABLE schedule (
		Day date NOT NULL,
		Boardgame varchar(60) NOT NULL,
		Venue varchar(125) NOT NULL,
		EventType varchar(60) NOT NULL,
		Primary key (Day),
		CREATE INDEX idx_schedule ON schedule(Boardgame),
		);
		





		

		
		
		
		
