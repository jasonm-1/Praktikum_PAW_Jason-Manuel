import { prisma } from "@/lib/prisma";
import Link from "next/link";

export default async function HomePage() {
  const articles = await prisma.article.findMany({
    include: { author: true },
    orderBy: { createdAt: 'desc' }
  });

  return (
    <main className="p-8 max-w-4xl mx-auto">
      <div className="mb-10 text-center">
        <h1 className="text-4xl font-extrabold text-gray-900 mb-2">Urban News</h1>
        <p className="text-gray-500">Berita terhangat dari komunitas untuk dunia.</p>
      </div>

      <div className="grid gap-8">
        {articles.length === 0 ? (
          <div className="text-center p-10 border-2 border-dashed rounded-xl">
            <p className="text-gray-400">Belum ada berita hari ini.</p>
          </div>
        ) : (
          articles.map((article) => {
            const isEdited = new Date(article.updatedAt).getTime() > new Date(article.createdAt).getTime() + 1000;

            return (
              <div key={article.id} className="group border-b pb-6 hover:border-blue-200 transition">
                <Link href={`/article/${article.id}`}>
                  <h2 className="text-2xl font-bold group-hover:text-blue-600 transition mb-2">
                    {article.title}
                  </h2>
                </Link>
                
                <p className="text-sm text-gray-500 flex flex-wrap items-center gap-1">
                  Oleh <span className="font-semibold text-gray-800">{article.author.name}</span> 
                  <span>•</span>
                  <span>
                    {new Date(article.createdAt).toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' })}
                  </span>
                  
                  {isEdited && (
                    <span className="italic text-gray-400 text-xs ml-1">
                      (Diedit: {new Date(article.updatedAt).toLocaleString('id-ID', { dateStyle: 'short', timeStyle: 'short' })})
                    </span>
                  )}
                </p>
              </div>
            );
          })
        )}
      </div>
    </main>
  );
}
