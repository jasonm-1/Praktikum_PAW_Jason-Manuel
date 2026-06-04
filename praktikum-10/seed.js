const { PrismaClient } = require('@prisma/client');
const prisma = new PrismaClient();

async function main() {
  console.log("Sedang mereset database untuk uji coba akhir...");
  
  await prisma.article.deleteMany();
  await prisma.user.deleteMany();

  const admin = await prisma.user.create({
    data: {
      name: 'Super Admin',
      email: 'admin@urban.com',
      password: 'rahasia123', 
      role: 'ADMIN',
    },
  });

  const penulis = await prisma.user.create({
    data: {
      name: 'Warga Lokal',
      email: 'penulis@urban.com', 
      password: 'rahasia123', 
      role: 'USER',
    },
  });

  await prisma.article.create({
    data: {
      title: 'Festival Bunga Musim Semi Segera Digelar',
      content: 'Pemerintah kota mengumumkan bahwa festival tahunan ini akan membawa konsep glassmorphism pada dekorasinya. Jangan sampai terlewat!',
      authorId: penulis.id, 
    },
  });

  console.log("Seed selesai! Database siap diuji coba dengan password transparan.");
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
