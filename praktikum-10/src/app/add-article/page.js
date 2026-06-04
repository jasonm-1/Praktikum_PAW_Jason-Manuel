import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";
import { getServerSession } from "next-auth";

export default async function AddArticlePage() {
  const session = await getServerSession();

  if (!session) redirect("/login");

  async function postArticle(formData) {
    "use server";
    const title = formData.get("title");
    const content = formData.get("content");

    await prisma.article.create({
      data: {
        title,
        content,
        author: { connect: { email: session.user.email } }
      }
    });

    redirect("/");
  }

  return (
    <main className="p-8 max-w-2xl mx-auto">
      <h1 className="text-2xl font-bold mb-6">Tulis Berita Baru</h1>
      <form action={postArticle} className="flex flex-col gap-4">
        <input name="title" placeholder="Judul Berita" className="border p-2 rounded" required />
        <textarea name="content" placeholder="Isi Berita" className="border p-2 rounded h-40" required />
        <button type="submit" className="bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Publikasikan</button>
      </form>
    </main>
  );
}
