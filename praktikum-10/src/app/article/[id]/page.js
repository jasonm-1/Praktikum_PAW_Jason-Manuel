"use client";
import { useState, useEffect, use } from "react";
import ConfirmModal from "@/components/ConfirmModal";
import { useSession } from "next-auth/react";
import { useRouter } from "next/navigation";

export default function ArticleDetail({ params: paramsPromise }) {
  const params = use(paramsPromise); 
  const { data: session } = useSession();
  const router = useRouter();
  
  const [article, setArticle] = useState(null);
  const [loading, setLoading] = useState(true);
  const [isModalOpen, setIsModalOpen] = useState(false);

  useEffect(() => {
    async function fetchArticle() {
      try {
        const res = await fetch(`/api/article/${params.id}`);
        const data = await res.json();
        
        if (res.ok) {
          setArticle(data);
        } else {
          console.error("Error dari server:", data.error);
        }
      } catch (error) {
        console.error("Gagal Fetch:", error);
      } finally {
        setLoading(false);
      }
    }
    fetchArticle();
  }, [params.id]);

  if (loading) return <div className="p-20 text-center italic text-gray-600">Loading...</div>;
  if (!article) return <div className="p-20 text-center text-red-600 font-bold">Berita Tidak Ditemukan (ID: {params.id})</div>;

  const isOwner = session?.user?.id === String(article.authorId);
  const isAdmin = session?.user?.role === "ADMIN";

  const handleDelete = async (reason) => {
    setIsModalOpen(false);

    const res = await fetch(`/api/article/${article.id}`, {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ reason })
    });
    if (res.ok) {
      router.push("/");
      router.refresh(); 
    }
  };

  return (
    <main className="p-8 max-w-4xl mx-auto min-h-screen pt-12">
      <div className="glass-card p-8 md:p-12">
        <h1 className="text-4xl font-extrabold mb-4 text-gray-800 drop-shadow-sm">{article.title}</h1>
        
        <div className="flex items-center gap-2 text-sm text-gray-600 mb-8 border-b border-white/40 pb-4">
          <span className="font-bold text-blue-800">{article.author?.name}</span>
          <span>•</span>
          <span>
            {new Date(article.createdAt).toLocaleString('id-ID', {
              dateStyle: 'long',
              timeStyle: 'medium'
            })}
          </span>
        </div>

        <article className="text-lg leading-relaxed whitespace-pre-wrap mb-10 text-gray-700">
          {article.content}
        </article>

        <div className="flex gap-4 pt-4 border-t border-white/40">
          <button 
            onClick={() => router.push("/")} 
            className="glass-button px-6 py-2 rounded-lg font-bold"
          >
            Kembali
          </button>

          {isOwner && (
            <button 
              onClick={() => router.push(`/article/${article.id}/edit`)} 
              className="glass-button glass-button-warning px-6 py-2 rounded-lg font-bold"
            >
              Edit Berita
            </button>
          )}

          {(isOwner || isAdmin) && (
            <button 
              onClick={() => setIsModalOpen(true)} 
              className="glass-button glass-button-danger px-6 py-2 rounded-lg font-bold"
            >
              Hapus
            </button>
          )}
        </div>
      </div>

      <ConfirmModal 
        isOpen={isModalOpen}
        onClose={() => setIsModalOpen(false)}
        onConfirm={handleDelete}
        title="Konfirmasi Hapus"
        message="Apakah Anda yakin? Tunggu 5 detik untuk melanjutkan."
        showReasonInput={isAdmin && !isOwner}
      />
    </main>
  );
}
