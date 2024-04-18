import { useState, useEffect } from "react";
import axios from "axios";
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

interface User {
    id: number;
    name: string;
    email: string;
}

const TableData: React.FC = () => {
    const [users, setUsers] = useState<User[]>([]);
    const [loading, setLoading] = useState<boolean>(true);
    const [deleteSuccess, setDeleteSuccess] = useState<boolean>(false);
    const { toast } = useToast();

    useEffect(() => {
        const fetchUsers = async () => {
            try {
                const response = await axios.get<{ results: User[] }>("/api/users");
                setUsers(response.data.results);
                setLoading(false);
            } catch (error) {
                console.error("Error fetching users:", error);
                setLoading(false);
            }
        };

        fetchUsers();
    }, [deleteSuccess]); // Refresh user list after successful deletion

    const handleDeleteUser = async (id: number) => {
        try {
            await axios.delete(`/api/usersdelete/${id}`);
            // Remove the deleted user from the local state
            setUsers(users.filter((user) => user.id !== id));
            setDeleteSuccess(true);
        } catch (error) {
            console.error("Error deleting user:", error);
        }
    };

    return (
        <div className="w-full">
            <h2 className="text-lg font-bold mb-4">User Data</h2>
            {loading ? (
                <p>Loading...</p>
            ) : (
                <table className="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th className="border border-gray-300 p-2">ID</th>
                            <th className="border border-gray-300 p-2">Name</th>
                            <th className="border border-gray-300 p-2">Email</th>
                            <th className="border border-gray-300 p-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {users.map((user) => (
                            <tr key={user.id}>
                                <td className="border border-gray-300 p-2">{user.id}</td>
                                <td className="border border-gray-300 p-2">{user.name}</td>
                                <td className="border border-gray-300 p-2">{user.email}</td>
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
                                                                        <span className="font-bold">{user.email}</span> has been successfully deleted
                                                                    </p>
                                                                ),
                                                                action: <ToastAction altText="Close">Close</ToastAction>,
                                                            });
                                                            handleDeleteUser(user.id);
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

export default TableData;
