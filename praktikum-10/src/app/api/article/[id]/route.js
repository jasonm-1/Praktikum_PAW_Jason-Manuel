import { prisma } from "@/lib/prisma";
import { getServerSession } from "next-auth";
import { NextResponse } from "next/server";

export async function GET(req, { params }) {
  try {
    const { id } = await params; 
    const article = await prisma.article.findUnique({
      where: { id: parseInt(id) },
      include: { author: { select: { id: true, name: true, email: true } } }
    });

    if (!article) return NextResponse.json({ error: "Berita tidak ada di database" }, { status: 404 });
    return NextResponse.json(article);
  } catch (error) {
    return NextResponse.json({ error: error.message }, { status: 500 });
  }
}

export async function DELETE(req, { params }) {
  try {
    const { id } = await params;
    const session = await getServerSession();
    const { reason } = await req.json();

    if (!session) return NextResponse.json({ error: "Unauthorized" }, { status: 401 });

    const article = await prisma.article.findUnique({ where: { id: parseInt(id) } });
    if (!article) return NextResponse.json({ error: "Not Found" }, { status: 404 });

    const isAdmin = session.user.role === "ADMIN";
    const isOwner = String(session.user.id) === String(article.authorId);

    if (isOwner || isAdmin) {
      if (isAdmin && !isOwner) {
        await prisma.notification.create({
          data: {
            userId: article.authorId,
            message: `Berita "${article.title}" dihapus oleh Admin.`,
            reason: reason || "Melanggar aturan komunitas.",
          }
        });
      }

      await prisma.article.delete({ where: { id: parseInt(id) } });
      return NextResponse.json({ message: "Berhasil dihapus" });
    }

    return NextResponse.json({ error: "Forbidden" }, { status: 403 });
  } catch (error) {
    return NextResponse.json({ error: error.message }, { status: 500 });
  }
}

export async function PUT(req, { params }) {
  try {
    const { id } = await params;
    const session = await getServerSession();
    const { title, content } = await req.json();

    if (!session) return NextResponse.json({ error: "Unauthorized" }, { status: 401 });

    const article = await prisma.article.findUnique({ where: { id: parseInt(id) } });
    if (!article) return NextResponse.json({ error: "Not Found" }, { status: 404 });

    if (String(session.user.id) !== String(article.authorId)) {
      return NextResponse.json({ error: "Forbidden" }, { status: 403 });
    }

    await prisma.article.update({
      where: { id: parseInt(id) },
      data: { title, content }
    });

    return NextResponse.json({ message: "Berhasil diupdate" });
  } catch (error) {
    return NextResponse.json({ error: error.message }, { status: 500 });
  }
}
