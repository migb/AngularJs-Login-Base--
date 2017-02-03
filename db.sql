/*============================================================================
  Create a database and name it "angularLogin", then import this sql file
  to create the table and populate it.

  @test user info = {
      username: root,
      passowrd: test
  }
=============================================================================*/

CREATE TABLE user
(
  `userId` INT AUTO_INCREMENT NOT NULL,
  `userName` VARCHAR(30) NOT NULL,
  `userPassword` CHAR(40) NOT NULL,
  `userToken` VARCHAR(100),
  PRIMARY KEY(userId)
);


INSERT INTO user VALUES(null,
                        'root',
                        'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',
                        'undefined');
