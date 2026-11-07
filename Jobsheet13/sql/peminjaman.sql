create table if not exists peminjaman (
    id serial primary key,
    buku_id integer not null references buku(id),
    anggota_id integer not null references anggota(id),
    tanggal_pinjam date not null default current_date,
    tanggal_kembali date,
    status varchar(20) not null default 'dipinjam'
);