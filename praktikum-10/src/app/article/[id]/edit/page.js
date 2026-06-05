"use client";
import { useState, useEffect, use } from "react";
import { useRouter } from "next/navigation";

export default function EditArticle({ params: paramsPromise }) {
  const params = use(paramsPromise);
  const router = useRouter();
  
  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");
  const [loading, setLoading] = useState(true);
  
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [countdown, setCountdown] = useState(5);

  useEffect(() => {
    async function fetchArticle() {
      const res = await fetch(`/api/article/${params.id}`);
      if (res.ok) {
        const data = await res.json();
        setTitle(data.title);
        setContent(data.content);
      }
      setLoading(false);
    }
    fetchArticle();
  }, [params.id]);

  useEffect(() => {
    let timer;
    if (isModalOpen && countdown > 0) {
      timer = setTimeout(() => setCountdown(countdown - 1), 1000);
    }
    return () => clearTimeout(timer);
  }, [isModalOpen, countdown]);

  const handleSave = async () => {
    setIsModalOpen(false);

    const res = await fetch(`/api/article/${params.id}`, {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ title, content })
    });

    if (res.ok) {
      router.push(`/article/${params.id}`); 
      router.refresh();
    }
  };

  if (loading) return <div className="p-20 text-center text-gray-600">Memuat form edit...</div>;

  return (
    <main className="p-8 max-w-4xl mx-auto min-h-screen pt-12">
      <div className="glass-card p-8 md:p-12">
        <h1 className="text-3xl font-extrabold mb-6 text-gray-800 drop-shadow-sm">Edit Berita</h1>
        
        <div className="flex flex-col gap-6">
          <input 
            type="text" 
            value={title}
            onChange={(e) => setTitle(e.target.value)}
            className="glass-input p-4 rounded-xl text-xl font-semibold w-full"
            placeholder="Judul Berita"
          />
          <textarea 
            value={content}
            onChange={(e) => setContent(e.target.value)}
            className="glass-input p-4 rounded-xl w-full h-72 leading-relaxed"
            placeholder="Isi berita..."
          />
        </div>

        <div className="mt-8 flex gap-4 pt-6 border-t border-white/40">
          <button 
            onClick={() => router.back()} 
            className="glass-button px-6 py-3 rounded-lg font-bold"
          >
            Kembali
          </button>
          <button 
            onClick={() => { setIsModalOpen(true); setCountdown(5); }} 
            className="glass-button glass-button-primary px-6 py-3 rounded-lg font-bold"
          >
            Simpan Perubahan
          </button>
        </div>
      </div>

      {isModalOpen && (
        <div className="fixed inset-0 bg-white/20 backdrop-blur-sm flex items-center justify-center z-50 transition-all">
          <div className="glass-card p-8 w-[400px] text-center">
            <h3 className="text-2xl font-bold mb-3 text-gray-800">Simpan Perubahan?</h3>
            <p className="text-gray-700 mb-8 font-medium">Pastikan tidak ada typo. Tindakan ini akan mengubah berita publik.</p>
            
            <div className="flex justify-end gap-4">
              <button 
                onClick={() => setIsModalOpen(false)} 
                className="glass-button px-5 py-2 rounded-lg font-bold"
              >
                Batal
              </button>
              <button 
                onClick={handleSave} 
                disabled={countdown > 0}
                className={`px-5 py-2 rounded-lg font-bold transition ${
                  countdown > 0 
                    ? "bg-blue-200/50 text-blue-800/50 cursor-not-allowed border border-blue-200" 
                    : "glass-button glass-button-primary"
                }`}
              >
                {countdown > 0 ? `Tunggu ${countdown}s` : "Ya, Simpan"}
              </button>
            </div>
          </div>
        </div>
      )}
    </main>
  );
}
