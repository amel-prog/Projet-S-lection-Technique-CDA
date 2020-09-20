CREATE DATABASE IF NOT EXISTS 'api_rest' DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
    CREATE TABLE 'Topic' 
    (
'Id' integer NOT NULL,
'Title' string NOT NULL,

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE 'Post' 
(
'Id' integer NOT NULL,
'Content' string NOT NULL,
'Author' string NOT NULL,
'Date' DateTime
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour la table 'Topic'
--
ALTER TABLE 'Topic' ADD PRIMARY KEY ('id');

--
-- Index pour la table 'Post`'
--
ALTER TABLE 'Post'
ADD PRIMARY KEY ('Id'),
ADD KEY 'Topic_id' ('Topic_id');

--
-- AUTO_INCREMENT pour la table `Topic`
--
ALTER TABLE 'Topic' MODIFY 'Id' int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table 'Post'
--
ALTER TABLE 'Post' MODIFY 'id' int bn NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Contraintes pour la table 'Post'
--
ALTER TABLE 'Post' ADD CONSTRAINT 'Post_ibfk_1' FOREIGN KEY ('Topic_Id') REFERENCES 'Topic' ('Id') ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO 'Topic' ('Id', 'Title') VALUES
INSERT INTO 'Post' ('Id', 'Content', 'Author', 'Date') VALUES