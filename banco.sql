create database forumbr;
use forumbr;

-- Tabela Usuario
create table if not exists usuarios (
	idUsuario bigint auto_increment,
	avatar varchar(40) null,
	nome varchar(70) not null,
	nickname varchar(30) not null,
	email varchar(70) not null,
	senha varchar(32) not null,
	dataCadastro datetime DEFAULT CURRENT_TIMESTAMP,
	primary key (idUsuario)
);

-- Tabela Topico
create table if not exists topicos (
	idTopico bigint auto_increment,
	titulo varchar(25) not null,
	slug varchar(50) not null,
	data datetime not null,
	dataModificacao datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	status char(1) not null default 'a',
	totalDiscussao bigint not null DEFAULT '0',
	totalMensagem bigint not null DEFAULT '0',
	idUsuario bigint not null,
	primary key (idTopico)
);
alter table topicos add constraint idUsuario_Topicosfk foreign key (idUsuario) references usuarios (idUsuario);

-- Tabela Discussao
create table if not exists conversas (
	idConversa bigint auto_increment,
	titulo varchar(25) not null,
	slug varchar(50) not null,
	data datetime not null DEFAULT CURRENT_TIMESTAMP,
	dataModificacao datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	reputacao bigint not null default '0',
	visualizacoes bigint not null default '0',
	idTopico bigint not null,
	idUsuario bigint not null,
	primary key (idConversa)
);
alter table conversas add constraint idTopico_Conversasfk foreign key (idTopico) references topicos (idTopico);
alter table conversas add constraint idUsuario_Conversasfk foreign key (idUsuario) references usuarios (idUsuario);

-- Tabela Mensagem
create table if not exists mensagens (
	idMensagem bigint auto_increment,
	texto text not null,
	id_parent bigint not null default '0',
	data datetime not null DEFAULT CURRENT_TIMESTAMP,
	dataModificacao datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	idDiscussao bigint not null,
	idUsuario bigint not null,
	primary key (idMensagem)
);
alter table mensagens add constraint idDiscussao_Mensagensfk foreign key (idDiscussao) references conversas (idConversa);
alter table mensagens add constraint idUsuario_Mensagensfk foreign key (idUsuario) references usuarios (idUsuario);

-- Tabela TagSeo
create table if not exists tagsseos (
    idTagSeo    int auto_increment,
    h1          varchar(180),
    slogan      varchar(120),
    descricao   varchar(180),
    tema        varchar(100),
    baseUrl     varchar(200),
    facebook    varchar(240),
    twitter     varchar(100),
    googleplus  varchar(240),
    youtube     varchar(240),
    tagsHead    text,
    tagsBody    text,
    tagsFoot    text,
    primary key (idTagSeo)
);