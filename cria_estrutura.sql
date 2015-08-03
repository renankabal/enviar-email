/**
Autor: Renan Jhonatha
email: fantasmaapoi@gmail.com
ano: 2015
Tabela de gerenciamento de email's
*/
--Cria a tabela de grupos de e-mail
CREATE TABLE gruposemail (
	codgrupoemail SERIAL PRIMARY KEY,
	grupoemail varchar (100),
	descricao text,
	datacadastro timestamp
);
--========================
--##Insere grupos de email
--========================
INSERT INTO gruposemail(grupoemail, descricao, datacadastro) VALUES ('ESCOLA', 'Lista de e-mail de escolas', now());
INSERT INTO gruposemail(grupoemail, descricao, datacadastro) VALUES ('FACULDADE', 'Lista de e-mail de faculdades', now());

--cria a tabela que vai receber os email
CREATE TABLE email (
	codemail serial primary key,
	email varchar (150),
	codgrupoemail INTEGER REFERENCES gruposemail (codgrupoemail),
	enviado character varying(1) DEFAULT 'n',
	datacadastro timestamp
);

INSERT INTO email (email, codgrupoemail, datacadastro) values ('aa@gmail.com', 1, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('ab@gmail.com', 1, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('bb@gmail.com', 1, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('bc@gmail.com', 1, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('cc@gmail.com', 1, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('ec@gmail.com', 1, now());

INSERT INTO email (email, codgrupoemail, datacadastro) values ('aa@hotmail.com', 2, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('ab@hotmail.com', 2, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('bb@hotmail.com', 2, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('bc@hotmail.com', 2, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('cc@hotmail.com', 2, now());
INSERT INTO email (email, codgrupoemail, datacadastro) values ('ec@hotmail.com', 2, now());