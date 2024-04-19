import { useState, useEffect } from "react";
import axios from "axios";
import dayjs from "dayjs";
import relativeTime from 'dayjs/plugin/relativeTime';
import { useToast } from "@/Components/ui/use-toast";
import { ToastAction } from "@/Components/ui/toast";

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/ui/dialog";
import { Trash2 } from "lucide-react";

interface Book {
    id: number;
    title: string;
    slug: string;
    created_at?: string; 
    borrowed_by?: number; 
    returned_by?: number;
    borrowed_date?: string;
    returned_date?: string;
}

const BookTableData: React.FC = () => {
    const [books, setBooks] = useState<Book[]>([]);
    const [loading, setLoading] = useState<boolean>(true);
    const [deleteSuccess, setDeleteSuccess] = useState<boolean>(false);
    const { toast } = useToast();

    useEffect(() => {
        const fetchBooks = async () => {
            try {
                const response = await axios.get<{ results: Book[] }>("/api/books");
                setBooks(response.data.results);
                setLoading(false);
            } catch (error) {
                console.error("Error fetching books:", error);
                setLoading(false);
            }
        };

        fetchBooks();
    }, [deleteSuccess]); // Refresh book list after successful deletion

    const handleDeleteBook = async (id: number) => {
        try {
            await axios.delete(`/api/booksdelete/${id}`);
            // Remove the deleted book from the local state
            setBooks(books.filter((book) => book.id !== id));
            setDeleteSuccess(true);
        } catch (error) {
            console.error("Error deleting books:", error);
        }
    };

    dayjs.extend(relativeTime);

    const getTimeAgo = (createdAt: string | undefined): string => {
        if (!createdAt) return "-";
        const created = dayjs(createdAt);
        return created.fromNow();
    };

    return (
        <div className="w-full">
            <h2 className="text-lg font-bold mb-4">Book Data</h2>
            {loading ? (
                <p>Loading...</p>
            ) : (
                <table className="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th className="border border-gray-300 p-2">Title</th>
                            <th className="border border-gray-300 p-2">Slug</th>
                            <th className="border border-gray-300 p-2">Created</th>
                            <th className="border border-gray-300 p-2">Borrowed By</th>
                            <th className="border border-gray-300 p-2">Returned By</th>
                            <th className="border border-gray-300 p-2">Borrowed Date</th>
                            <th className="border border-gray-300 p-2">Returned Date</th>
                            <th className="border border-gray-300 p-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {books.map((book) => (
                            <tr key={book.id}>
                                <td className="border border-gray-300 p-2">{book.title}</td>
                                <td className="border border-gray-300 p-2">{book.slug}</td>
                                <td className="border border-gray-300 p-2">{getTimeAgo(book.created_at)}</td>
                                <td className="border border-gray-300 p-2">{book.borrowed_by || "-"}</td>
                                <td className="border border-gray-300 p-2">{book.returned_by || "-"}</td>
                                <td className="border border-gray-300 p-2">{book.borrowed_date || "-"}</td>
                                <td className="border border-gray-300 p-2">{book.returned_date || "-"}</td>
                                <td className="border border-gray-300 p-2">
                                    <Dialog>
                                        <DialogTrigger className="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-xs px-3 py-1.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2"><Trash2 className="text-red-500 h-4 w-4" /></DialogTrigger>
                                        <DialogContent>
                                            <DialogHeader>
                                                <DialogTitle>Are you absolutely sure?</DialogTitle>
                                                <DialogDescription>
                                                
                                                    <button
                                                        onClick={() => {
                                                            toast({
                                                                variant: "destroy",
                                                                title: "",
                                                                description: (
                                                                    <p>
                                                                        <span className="font-bold">{book.title}</span> has been successfully deleted
                                                                    </p>
                                                                ),
                                                                action: <ToastAction altText="Close">Close</ToastAction>,
                                                            });
                                                            handleDeleteBook(book.id);
                                                        }}
                                                        className="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                                    >
                                                        Delete
                                                    </button>
                                                </DialogDescription>
                                            </DialogHeader>
                                        </DialogContent>
                                    </Dialog>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
};

export default BookTableData;
