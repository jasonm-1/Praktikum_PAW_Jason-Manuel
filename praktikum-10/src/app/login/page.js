"use client";
import { signIn } from "next-auth/react";
import { useState } from "react";
import { useRouter } from "next/navigation";

export default function LoginPage() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const router = useRouter();

  const handleSubmit = async (e) => {
    e.preventDefault();
    const res = await signIn("credentials", {
      email,
      password,
      redirect: false,
    });

    if (res.ok) {
      router.push("/"); 
      router.refresh();
    } else {
      alert("Login Gagal! Cek email & password-mu.");
    }
  };

  return (
    <main className="flex flex-col items-center justify-center min-h-screen">
      <form onSubmit={handleSubmit} className="p-8 border rounded-lg shadow-md w-80">
        <h1 className="text-2xl font-bold mb-4">Login Portal</h1>
        <input 
          type="email" placeholder="Email" className="w-full border p-2 mb-2 rounded"
          onChange={(e) => setEmail(e.target.value)} 
        />
        <input 
          type="password" placeholder="Password" className="w-full border p-2 mb-4 rounded"
          onChange={(e) => setPassword(e.target.value)} 
        />
        <button type="submit" className="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
          Masuk
        </button>
      </form>
    </main>
  );
}
